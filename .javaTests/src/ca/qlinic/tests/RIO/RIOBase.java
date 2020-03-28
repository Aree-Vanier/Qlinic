package ca.qlinic.tests.RIO;

import org.openqa.selenium.By;
import org.openqa.selenium.Dimension;
import org.openqa.selenium.Keys;
import org.openqa.selenium.WebDriver;

import ca.qlinic.tests.Test;

public class RIOBase extends Test{

	WebDriver driver;
	
	public RIOBase() {
		super("https://qlinic.gregk.ca/RIO/rlogin");
		setSize(1920, 1080);
		setCloseOnExit(false);
	}

	@Override
	protected void execute(WebDriver driver) throws InterruptedException {
		System.out.println("Base executing");
	    driver.findElement(By.name("login")).sendKeys("Jeff");
	    driver.findElement(By.name("password")).sendKeys("Bezos");
	    driver.findElement(By.name("password")).sendKeys(Keys.ENTER);
	    this.driver = driver;
	    System.out.println("Base Ready");
	}

}
