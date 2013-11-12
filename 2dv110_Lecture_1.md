# Lecture 1. Testing basics
	This quiz is intended to test you on the content of lecture 1.

## What is the goal of testing?
	Check all that apply
 - To completely verify that the code is correct
 + Uncovering errors
 + Build confidence in the software
 - prove correctness
 
## Errors and Faults
	Check all that apply
 - An error always leads to a fault in the software
 + An error may lead to a fault
 - faults can always be observed
 - Implementation outside of the specification is always faulty!
 + An Omission can be intentional
 + There can be several correct implementations of the same specification
 
## A bug can be found in
	Check all that apply
 + System Under Test
 + Specification
 + Requirements
 + Operating System
 + Hardware

## What qualities are dynamically determined?
	Check all that apply
 - Source code is maintainable
 - Source code is testable
 - Source code compiles without errors
 - Documentation is Correct
 - Documentation contains all intended aspects
 + Software produces correct output
 + All requirements are implemented
 + All GUI components are consistent
 + The performance is 

## What input is part of the methods input domain?
	public int max(int A, int B) {
		int ret = B;
		if (A > B) {
			return A;
		}
		return B;
	}
 - A = +5 B = 'C'
 + A = 0 & B = 0
 + A = -5 & B = intvalue(4.3);
 - All positive integers
 - All negative integers
 + A is any number in [-214783648 -> 2,147,483,647] if int is 32 bit
 + B is any number in [-214783648 -> 2,147,483,647] if int is 32 bit
 
## Reliability and Correctness
	Check all that apply
 + A program is 100% reliable if it is Correct
 - A program is correct even if a requirement is not implemented
 + A program can be correct even if it ends with an error output
 + If there are two different numbers in the input domain and we have tested one with correct output, we have at least 50% reliability
 + A program that receives input outside of its input domain and crashes can be correct
 
## A test plan tells us:
	Check all that apply
 - The specific test-cases
 - The requirements in use-case form
 - The specific test-data
 + How test results should be presented and reported.
 + What qualities we are focusing on
 
## Testing activities
	Check all that apply
 - Beta testing is done during coding
 + Unit testing is done by programmers
 + Regression testing can be automated
 + Customers should be involved in testing

## Testing Types
	Check all that apply
 + In black box testing we have knowledge of the requirements
 - In black box testing we have knowledge of the code
 + In white box testing we have knowledge of the code
 + In white box testing we have knowledge of the requirements
 + Interface testing is always black box testing
 + Model based testing requires a formal model of the requirements
 - Model based testing requires a formal model of the code

## Oracle
	Check all that apply
 + The oracle decides if the output is considered correct
 + The oracle decides if the output is considered incorrect
 + Humans can be oracles
 + Oracles can be constructed from formal models
