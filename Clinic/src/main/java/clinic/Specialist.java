package clinic;

class Specialist extends Doctor {
    public Specialist(String name, String specialization, String availability) {
        super(name, specialization, availability);
    }

    public void displayAvailability() {
        System.out.println(getName() + " (Specialist in " + getSpecialization() + ") requires an appointment. Available at: " + getAvailability());
    }
}
