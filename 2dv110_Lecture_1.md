# Lecture 1. Testing basics
	This quiz is intended to test you on the content of lecture 1.

## What is the goal of testing?
	Check all that applies
 - To completely verify that the code is correct
 + Uncovering errors
 + Build confidence in the software
 - prove correctness
 
## Errors and Faults
	Check all that applies
 - An error always leads to a fault in the software
 + An error may lead to a fault
 - faults can always be observed
 - Implementatiion outside of the specification is always faulty!
 + An Omission can be intentional
 + There can be several correct implementations of the same specification
 
## A bug can be found in
	Check all that applies
 + System Under Test
 + Specification
 + Requirements
 + Operating System
 + Hardware

## What qualities are dynamically determined?
	Check all that applies
 - Source code is maintainable
 - Source code is testable
 - Source code compiles without errors
 - Documentation is Correct
 - Documentation contains all intended aspects
 + Software produces correct output
 + All requirements are implemented
 + All GUI components are consistent
 + The performance is 

## What input is in the input domain?
	public int max(int A, int B) {
		int ret = B;
		if (A > B) {
			return A;
		}
		return B;
	}
 + +5
 + 0
 + -5
 - All positive integers
 - All negative integers
 + A = [-214783648 -> 2,147,483,647] if int is 32 bit
 + B = [-214783648 -> 2,147,483,647] if int is 32 bit
 
## Reliability
	Check all that applies
 + A program is 100% reliable if it is Correct
 + A program can be correct even if it ends with an error output
 + If there are two different numbers in the input domain and we have tested one with correct output, we have at least 50% reliability
 + A program that receives input outside of its input domain and crashes can be correct
 
## A test plan tells us:
	Check all that applies
 - The specific test-cases
 - The requirements in use-case form
 - The specific test-data
 + How test results should be presented and reported.
 + What qualities we are focusing on
 
## Testing activities
	Check all that applies
 - Beta testing is done during coding
 + Unit testing is done by programmers
 + Regression testing can be automated
 + Customers should be involved in testing


