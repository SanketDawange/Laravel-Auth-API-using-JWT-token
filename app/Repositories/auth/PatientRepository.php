<?php
namespace App\Repositories\auth;

use Illuminate\Support\Facades\DB;
use App\Models\Patient;

class PatientRepository
{

    public function findWithoutFail($id)
    {
        try {
            $patient = Patient::find($id);
            return $patient;
        } catch (\Exception $e) {
            return null;
        }
    }


    public function update($patientId, array $attributes)
    {
        try {
            DB::beginTransaction();

            $patient = Patient::findOrFail($patientId);
            $patient->update($attributes);

            DB::commit();
            return $patient;
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e);
            throw $e;
        }
    }

    public function findPatientWithUSer($id) {
        try {

            $patient = Patient::where('user_id', $id)->first();
            return $patient;

        } catch (\Exception $e) {

            \Log::error($e);
            return null;
        }
    }


}
