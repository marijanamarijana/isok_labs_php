<?php

enum Specialization:string{
    case FAMILY_MEDICINE = "family_medicine";
    case CARDIOLOGY = "cardiology";
    case NEUROLOGY = "neurology";
    case RADIOLOGY = "radiology";
}

trait Treatable{
    public function diagnose(Patient $patient, string $diagnosis): void
    {
        $patient->medicalHistory[] = $diagnosis;
    }
}

class Patient{
    public int $id;
    public string $name;
    public array $medicalHistory = [];
    public array $treatmentHistory = [];
    public function __construct(int $id,string $name){
        $this->id = $id;
        $this->name = $name;
    }
    public function printData():void{
        echo "Patient id".$this->id."  Patient name: ".$this->name."<br>";
    }

    public function getMedicalHistory(): array
    {
        return $this->medicalHistory;
    }

}

abstract class Doctor{
    protected string $id;
    public string $name;
    protected int $years_experience;
    protected Specialization $specialization;
    protected array $patients = [];

    public function __construct(string $id,string $name, int $years_experience,Specialization $specialization){
        $this->id = $id;
        $this->name = $name;
        $this->years_experience = $years_experience;
        $this->specialization = $specialization;
    }
    public function printPatients(): void
    {
        if (empty($this->patients)) {
            echo "{$this->name} has no patients.\n";
            return;
        }

        echo "<br>"."PRINTING PATIENTS FOR {$this->name}: "."<br>";
            foreach ($this->patients as $patient){
                $patient->printData();
            }
    }
    public function hasPatient(Patient $patient): bool {
        if (isset($this->patients[$patient->id])) {
            return true;
        }
        return false;
    }

    public function getDoctorsBySpecialization(array $doctors, Specialization $specialization): array
    {
        return array_filter($doctors, fn(Doctor $d) => $d->getSpecialization() === $specialization);
    }

    public function getSpecialization(): Specialization
    {
        return $this->specialization;
    }
    public function addPatient(Patient $patient): void{
        if(!$this->hasPatient($patient)){
            $this->patients[$patient->id] = $patient;
        }
    }
    public function getYearsExperience(): int
    {
        return $this->years_experience;
    }
}

class FamilyDoctor extends Doctor{
    use Treatable;
    public function __construct(string $id, string $name, int $years_experience)
    {
        parent::__construct($id, $name, $years_experience, Specialization::FAMILY_MEDICINE);
    }

    public function refer(Patient $patient, array $doctors, Specialization $specialization): Doctor{
        $spec_doctors = $this->getDoctorsBySpecialization($doctors, $specialization);
        $max_year_doc = $spec_doctors[0];

        foreach ($spec_doctors as $doctor){
            if ($max_year_doc->getYearsExperience() < $doctor->getYearsExperience()){
                $max_year_doc = $doctor;
            }
        }
        $max_year_doc->addPatient($patient);
        return $max_year_doc;
    }
}

class Specialist extends Doctor
{
    public function __construct(string $id, string $name, int $years_experience, Specialization $specialization)
    {
        parent::__construct($id, $name, $years_experience, $specialization);
    }

    public function treatPatient(Patient $patient, string $treatment): void
    {
        $patient->treatmentHistory[] = $treatment;
        unset($this->patients[$patient->id]);

    }
}

$john = new Patient(1, "John Doe");
$jane = new Patient(2, "Jane Smith");

// Create doctors
$familyDoctor = new FamilyDoctor("D001", "Dr. Brown", 12);
$cardiologist1 = new Specialist("D002", "Dr. Heart", 8, Specialization::CARDIOLOGY);
$cardiologist2 = new Specialist("D003", "Dr. Pulse", 15, Specialization::CARDIOLOGY);
$neurologist = new Specialist("D004", "Dr. Brain", 10, Specialization::NEUROLOGY);

// Add patient to family doctor
$familyDoctor->addPatient($john);
$familyDoctor->diagnose($john, 'High blood pressure');
// Print before referral
$familyDoctor->printPatients();

// Refer John to cardiologist (most experienced one)
$treatingDoctor = $familyDoctor->refer($john, [$cardiologist1, $cardiologist2, $neurologist], Specialization::CARDIOLOGY);
echo "Referred patient with id $john->id to doctor $treatingDoctor->name\n";

// Refer the same patient again (should return that patient is already referred)
$treatingDoctor = $familyDoctor->refer($john, [$cardiologist1, $cardiologist2, $neurologist], Specialization::CARDIOLOGY);

$treatingDoctor->printPatients();

if ($treatingDoctor instanceof Specialist) {
    $treatingDoctor->treatPatient($john, 'Beta-blockers');
}

// Print specialists’ patients after referral
$treatingDoctor->printPatients();

// Show John’s medical history
echo "\nMedical history of {$john->name}:\n";
foreach ($john->getMedicalHistory() as $record) {
    echo "- $record\n";
}