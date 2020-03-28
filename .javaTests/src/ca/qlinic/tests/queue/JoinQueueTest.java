package ca.qlinic.tests.queue;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;

import ca.qlinic.tests.Evaluation;
import ca.qlinic.tests.Result;
import ca.qlinic.tests.Test;

public class JoinQueueTest extends Test{

	String name;
	String phone;
	String email;
	
	public JoinQueueTest(String name, String phone, String email) {
		super("http://qlinic.gregk.ca/queue/join");
		this.name = name;
		this.email = email;
		this.phone = phone;
	}
	
	public JoinQueueTest(String name, String phone, String email, Object eval) {
		super("http://qlinic.gregk.ca/queue/join");
		this.name = name;
		this.email = email;
		this.phone = phone;
		setEval((Evaluation) eval);
	}

	@Override
	protected void execute(WebDriver driver) throws InterruptedException {
	    String initialUrl = driver.getCurrentUrl();
		driver.findElement(By.id("name")).click();
	    driver.findElement(By.id("name")).sendKeys(name);
	    driver.findElement(By.id("email")).sendKeys(email);
	    driver.findElement(By.id("phone")).sendKeys(phone);
	    driver.findElement(By.cssSelector("input:nth-child(2)")).click();
	    Thread.sleep(1500);
	    //System.out.println(initialUrl +"|"+ driver.getCurrentUrl());
	    if(driver.getCurrentUrl().equals(initialUrl)) {
	    	//System.out.println("Page unchanged");
	    	String error = driver.findElement(By.cssSelector("#error .dialog .dialogContent")).getText();
	    	//System.out.println(error);
	    	result = new JoinResult(error);
	    	return;
	    }
	    //System.out.println("Next page");
	    int position = Integer.parseInt(driver.findElement(By.id("position")).getText());
	    String code = driver.findElement(By.id("code")).getText();
	    result = new JoinResult(position, code);
//	    driver.findElement(By.cssSelector("section:nth-child(2)")).click();
	}
	
	@Override
	public JoinResult getResult() {
		return (JoinResult) result;
	}
}


