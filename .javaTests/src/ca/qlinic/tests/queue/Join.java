package ca.qlinic.tests.queue;

public class Join {

	static JoinQueueTest[] tests = { 
			new JoinQueueTest("Test 1", "", ""), 
			new JoinQueueTest("Test 2", "", ""),
			new JoinQueueTest("Test 3", "", ""), 
			new JoinQueueTest("Test 4", "", ""),
			new JoinQueueTest("Test 5", "", ""),
			new JoinQueueTest("Test 6", "", ""),
			new JoinQueueTest("Test 7", "", ""),
			new JoinQueueTest("Test 8", "", ""),
			new JoinQueueTest("Test 9", "", ""),
			new JoinQueueTest("Test 10", "", ""),
			new JoinQueueTest("Test 11", "", ""),
			new JoinQueueTest("Test 12", "", ""),
			new JoinQueueTest("Test 13", "", ""),
			new JoinQueueTest("Test 14", "", ""),
			new JoinQueueTest("Test 15", "", ""),
			new JoinQueueTest("Test 16", "", ""),
			new JoinQueueTest("Test 17", "", ""),
			new JoinQueueTest("Test 18", "", ""),
			new JoinQueueTest("Test 19", "", ""),
			new JoinQueueTest("Test 20", "", ""),
			new JoinQueueTest("Test 21", "", ""),
			new JoinQueueTest("Test 22", "", ""),
			new JoinQueueTest("Test 23", "", ""),
			new JoinQueueTest("Test 24", "", ""),
			new JoinQueueTest("Test 25", "", ""),
			new JoinQueueTest("Test 26", "", ""),
			new JoinQueueTest("Test 27", "", ""),
			new JoinQueueTest("Test 28", "", ""),
			new JoinQueueTest("Test 29", "", ""),
			new JoinQueueTest("Test 30", "", ""),
			new JoinQueueTest("Test 31", "", ""),
			new JoinQueueTest("Test 32", "", ""),
			new JoinQueueTest("Test 33", "", ""),
			new JoinQueueTest("Test 34", "", ""),
			new JoinQueueTest("Test 35", "", ""),
			new JoinQueueTest("Test 36", "", ""),
			new JoinQueueTest("Test 37", "", ""),
			new JoinQueueTest("Test 38", "", ""),
			new JoinQueueTest("Test 39", "", ""),
			new JoinQueueTest("Test 40", "", "") };
	
	static int success = 0;
	static int failed = 0;
	
	public static void main(String[] args) throws InterruptedException {
		for (JoinQueueTest test : tests) {
			Thread.sleep(100);
			test.setEval(() -> test.getResult().error.matches(""));//.*ERROR:DUPLICATE.*"));
			test.execute();
		}
		for (JoinQueueTest test : tests) {
			test.await();
			if (test.getResult().success) {
//				System.out.println("Name: "+test.name);
//				System.out.println("Position: "+test.getResult().position);
//				System.out.println("Code: "+test.getResult().code);
				success ++;
			} else {
				System.out.println("Test: "+test.name);
				System.out.println("Result:" + test.getResult().error);
				System.out.println("Evaluated: " + test.evaluate());
				failed ++;
				System.out.println("----------\n");
			}
		}
		
//		for(int i=0; i<200; i++) {
//			Thread.sleep(60000);
//			JoinQueueTest test = new JoinQueueTest("Long "+i, "", "");
//			test.setEval(() -> test.getResult().error.matches(""));//.*ERROR:DUPLICATE.*"));
//			test.execute();
//			test.await();
//			if (test.getResult().success) {
////				System.out.println("Name: "+test.name);
////				System.out.println("Position: "+test.getResult().position);
////				System.out.println("Code: "+test.getResult().code);
//				success ++;
//			} else {
//				System.out.println("Test: "+test.name);
//				System.out.println("Result:" + test.getResult().error);
//				System.out.println("Evaluated: " + test.evaluate());
//				failed ++;
//				System.out.println("----------\n");
//			}
//			
//			
//		}
		
		System.out.println("Success: "+success);
		System.out.println("Failed: "+failed);
	}
}
