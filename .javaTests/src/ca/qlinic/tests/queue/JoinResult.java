package ca.qlinic.tests.queue;

import ca.qlinic.tests.Result;

public class JoinResult extends Result{
	public int position;
	public String code;

	public JoinResult(int position, String code) {
		this.position = position;
		this.code = code;
		success = true;
	}
	
	public JoinResult(String error) {
		super(error);
	}

}
