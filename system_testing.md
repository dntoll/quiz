# Lecture. System Testing
	This quiz is intended to test you on the content of the lecture on TDD

## What is the goal of a test plan?
	Check all that apply
 + Find out what should be tested.
 + Contain all requirements that should be tested this iteration
 + Show Risks
 + When will a test run?
 - get better understanding of the problem
 - to contain test-cases
 + to produce test-cases
 + 
 
## What are the levels of the Requirements pyramid
	Check all that apply
 - Vision, Use-Cases, Requirements
 - Needs, Features, Use-cases/Specification, Scenarios
 + Needs, Features, Use-cases/Specification, Scenarios, Test Cases
 + Needs, Features, Use-cases/Specification, Scenarios, Test Cases, Test Data
 - Test-Cases, Use-cases, Test data

## How can we derive tests from Use-cases?
	Check all that apply
 + Only test main success scenario
 - We cannot derive tests from Use-cases
 + Randomly create scenarios from a use-case activity diagram
 + Make sure all paths are covered in the use-case activity diagram
 + Minimize the duplicate paths taken in the use-case activity diagram
 
## Why do we need traceability?
 + To verify all requirements are covered.
 + To focus testing
 + To show the customer his needs are fullfilled.
 + To find out what test-cases should be removed when a requirement changes.
 - To make nice graphs
 
## What are examples of non-functional requirements?
 + Usability
 + Localization
 + Scalability
 - Register new user
 + Compability
 + Compliance

## What is the problem with exhaustive testing?
 + Takes too much time
 - Gives no extra feedback
 - No problem
 + Not practically possible

## How large is the input domain for the following method
	//username may only contain [a-zA-Z]
	//short is 16 bits
	int findUser(char[8] username, unsigned short userId, boolean searchByUsername)
 - 256 * 8 * 65536 * 2
 + 52 * 8 * 65536 * 2
 - 52 * 8 * 256 * 2
 - 255 * 65536 * 8 * 2


## Equivalence Partitioning
 + Two subpartitions may be disjoint
 - Two subpartitions may include the same item
 + We can combine several partitions to create usecases

