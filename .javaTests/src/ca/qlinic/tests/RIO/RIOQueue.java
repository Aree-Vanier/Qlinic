package ca.qlinic.tests.RIO;

import ca.qlinic.tests.queue.JoinQueueTest;

public class RIOQueue {

	static RIOBase base;
	static int success = 0;
	static int failed = 0;
	public static void main(String[] args) throws InterruptedException {
		base = new RIOBase();
		base.execute();
		base.await();
		
		
		for(int i=0; i<50; i++) {
			join("Queue "+i);
			Thread.sleep(2*60*1000);
			join("Queue"+i);
			Thread.sleep(2*60*1000);
			serve();
			Thread.sleep(60*1000);
		}
		
		
	}
	
	public static void join(String name) {
		JoinQueueTest test = new JoinQueueTest(name, "", "");
		test.execute();
		test.await();
//		if(test.getResult().error=="") {
//			success++;
//		} else {
//			failed++;
//		}
	}
	
	public static void serve() {
		ServeNextTest test = new ServeNextTest();
		test.execute(base);
	}
}
