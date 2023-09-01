<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Repositories\auth\PatientRepository;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class PatientController extends Controller
{
    /** @var PatientRepository */
    private $patientRepository;

    public function __construct(PatientRepository $patientRepo)
    {
        $this->patientRepository = $patientRepo;
    }

    public function getPatient(Request $request) {

        $user = $request->user();
        $patient = $this->patientRepository->findPatientWithUSer($user->id);

        return response()->json(['message' => 'Patient data fetched successfully', 'patient' => $patient]);
    }

    public function updatePatient(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_first_name' => 'string|max:255',
            'patient_last_name' => 'string|max:255',
            'patient_dob' => 'date',
            'patient_gender' => 'in:M,F,OTHER',
            'city_id' => 'integer|exists:cities,id',
            'state_id' => 'integer|exists:states,id',
            'zip_code_id' => 'integer|exists:zip_codes,id',
            'country_id' => 'integer|exists:countries,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try {
            $user = $request->user();
            $patient = Patient::where('user_id', $user->id)->first();
            $patient = $this->patientRepository->update($patient->id, $request->all());

            return response()->json(['message' => 'Patient updated successfully', 'patient' => $patient]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
