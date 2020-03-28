package ca.qlinic.tests;

public abstract class Result {

	public boolean success;
	public String error = "";
	
	public Result() {
		this.success = true;
	}
	
	public Result(String error) {
		this.error = error;
		this.success = false;
	}
}
