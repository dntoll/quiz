# Lecture. System Testing
	This quiz is intended to test you on the content of the lecture on System test

## What is the goal of a test plan?
	Check all that apply
 + Find out what should be tested.
 + Specify all requirements that should be tested this iteration
 + Show Risks
 + When will a test run?
 - get better understanding of the problem
 - to contain test-cases
 + to produce test-cases

## What would you include in a test-plan?
 - All relevant specific test-cases are specified in detail.
 + A record of all requirements that we intend to focus on
 + A list of risks that could affect testing
 + A due end date.
 + Specification on what kinds of testing we are to conduct.

## What parts does a test-case consists of
+ Input
- detailed information about the requirement tested
+ Traceability to use-case
+ Expected output
+ Preconditions

## Manual test-cases...
+ ... can be automated
- ... has always unambigous interpretations
- ... always tests a system as a whole
 
## Reproducibility is
- the ability to rerun a test case with the same output, every time
- the ability to rerun a test case with the same output, some of the time
+ the ability to rerun a test case with the same outcome, all the time

 
## What are the levels of the Requirements pyramid
	Check all that apply
 - Vision, Use-Cases, Requirements
 - Needs, Features, Use-cases/Specification, Scenarios
 + Needs, Features, Use-cases/Specification, Scenarios, Test Cases
 - Needs, Features, Use-cases/Specification, Scenarios, Test Cases, Test Data
 - Test-Cases, Use-cases, Test data

## What is traceability?
	Mark what is true about traceability.
- Traceability is to have reproducible tests results.
+ A way of connecting a failing test to the feature requested by a customer.
+ Traceability can be used to minimize the set of tests needed.
+ The ability to connect Non functional requirements to test-cases
+ The ability to connect functional requirements to test-cases
- Traceability is testing of a non functional requirement
+ the ability to remove invalid test-cases when a requirement is changed.

## Traceability, How can we achieve it?
+ By naming convention (name, number) of the use cases and test cases
+ By a test matrix, showing dependencies
- By making sure we have a limited input domain
- By testing functional requirements
- by doing compatibility testing

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
 
## How can we make sure that we have full path coverage on a use-case that contains a loop?
- Randomly create scenarios from a use-case activity diagram
- We cannot derive tests from Use-cases
+ Create test cases from paths and make sure all paths are covered in the use-case activity diagram.
+ step through all loops once

## What are examples of non-functional requirements?
+ The system should have 99% uptime.
+ The system should have maximum response time of 1 second.
+ The system must use a mysql database.

## What are examples of non-functional requirements?
 + Usability
 + Localization
 + Scalability
 - Register new user
 + Compability
 + Compliance

## How can security be tested on a web-application.
+ Exploratory testing of input constraints
+ Try SQL-Injections on input fields
+ Manual inspection of cookies 
+ Making sure login forms are delivered over HTTPS
+ Making sure a session cookie cannot be created unless we are using HTTPS
+ Try to accessing restricted content when not logged in.

## Is exploratory testing automated?
 + No
 - Yes


## What are the advantages of exploratory testing?
+ ET tests tests the system as it is not intended to be used.
+ ET avoids the saturation effect by introducing new ways of testing.
+ In ET you deduct new tests from the experience of previous tests
- We can review the tests in advance.
- Can easily be reproduced.
+ Exploratory testing builds domain knowledge 

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
 + Partitioning may be done by black box or whitebox 
 + We can combine several partitions to create usecases

## What is regression testing?
- It is to test new requirements that has never been tested before.
+ It is to rerun testing of requirements that already has been tested once without changing anything
+ It is to rerun testing of requirements that already has been tested after a change.
+ It is intended to help us avoid introducing faults when we change the system.
