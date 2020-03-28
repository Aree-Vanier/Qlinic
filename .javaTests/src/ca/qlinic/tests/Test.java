package ca.qlinic.tests;

import org.openqa.selenium.Dimension;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.firefox.FirefoxDriver;
import org.openqa.selenium.ie.InternetExplorerDriver;

public abstract class Test implements Runnable{

	public enum Browser {
		CHROME, FIREFOX, IE
	}
		
	private static final String CHROME_LOCATION="C:\\Users\\Greg\\Downloads\\chromedriver_win32\\chromedriver.exe";

	private Dimension size = new Dimension(375, 667);
	private String URL;
	private Browser browser = Browser.CHROME;
	protected Result result;
	private boolean async = true;
	private boolean closeOnExit = true;
	private Thread t;
	private Evaluation eval;

	public Test(String page) {
		System.setProperty("webdriver.chrome.driver",CHROME_LOCATION);
		this.URL = page;
	}
	
	public void setSize(int width, int height) {
		this.size = new Dimension(width, height);
	}
	
	public void setEval(Evaluation e) {
		eval = e;
	}

	public int[] getSize() {
		return new int[] { size.width, size.height };
	}

	public void execute() {
		if(async) {
			t = new Thread(this);
			t.start();
		} else {
			run();
		}
	}
	
	public void run() {
		//Create the driver
		WebDriver driver;
		switch (browser) {
		case IE:
			driver = new InternetExplorerDriver();
		case FIREFOX:
			driver = new FirefoxDriver();
			break;
		case CHROME:
		default:
			driver = new ChromeDriver();
			break;
		}
		
		//Create the request
		driver.get(URL);
		driver.manage().window().setSize(this.size);
		try {
			execute(driver);
		} catch (InterruptedException e) {
			e.printStackTrace();
		}
		
		if(closeOnExit) {
			driver.quit();
		}
	}

	protected abstract void execute(WebDriver driver) throws InterruptedException;
	
	public void await(int timeout) {
		if(t==null)
			return;
		try {
			//System.out.println("Waiting");
			t.join(timeout);
		} catch (InterruptedException e) {
			e.printStackTrace();
		}
	}
	
	public boolean evaluate() {
		return eval.evalutate();
	}
	
	public void await() {
		await(0);
	}
	
	public Result getResult() {
		return result;
	}

	public boolean getAsync() {
		return async;
	}

	public void setAsync(boolean async) {
		this.async = async;
	}
	
	public boolean getCloseOnExit() {
		return closeOnExit;
	}
	
	public void setCloseOnExit(boolean state) {
		this.closeOnExit = state;
	}
}
