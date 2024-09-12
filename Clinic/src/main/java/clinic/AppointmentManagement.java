package clinic;

import java.util.*;

class AppointmentManagement {
    private List<Doctor> doctors;
    private List<Patient> patients;
    private List<Appointment> appointments;

    public AppointmentManagement() {
        doctors = new ArrayList<>();
        patients = new ArrayList<>();
        appointments = new ArrayList<>();
    }

    public void addDoctor(Doctor d) {
        doctors.add(d);
    }

    public void addPatient(Patient p) {
        patients.add(p);
    }

    public void viewDoctor() {
        System.out.println("Available Doctors:");
        for (Doctor d : doctors) {
            d.displayAvailability();
        }
    }

    public void bookAppointment(Patient p, Doctor d, String appointmentDate) {
        Appointment ap = new Appointment(d, p, appointmentDate);
        appointments.add(ap);
        System.out.println("Appointment booked successfully!");
    }

    public void viewAppointments() {
        System.out.println("All Appointments:");
        for (Appointment ap : appointments) {
            ap.displayAppointmentDetails();
        }
    }

    public List<Patient> getPatients() {
        return patients;
    }

    public List<Doctor> getDoctors() {
        return doctors;
    }
}
