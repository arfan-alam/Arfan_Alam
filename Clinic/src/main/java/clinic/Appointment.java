package clinic;

class Appointment {
    private Doctor doctor;
    private Patient patient;
    private String appointmentDate;

    public Appointment(Doctor doctor, Patient patient, String appointmentDate) {
        this.doctor = doctor;
        this.patient = patient;
        this.appointmentDate = appointmentDate;
    }
  public void displayAppointmentDetails() {
        System.out.println("Appointment Details: ");
        System.out.println("Patient: " + patient.getName() + " has an appointment with Dr. " + doctor.getName() + " on " + appointmentDate);
    }
  
}
