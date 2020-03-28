package ca.qlinic.tests.RIO;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;

public class ServeNextTest{

	protected void execute(RIOBase base) {
		WebDriver driver = base.driver;
	    driver.findElement(By.cssSelector("#queue > button")).click();
	}

}
