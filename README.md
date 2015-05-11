# WebSalesmanAnalysis
The Web Salesman Analysis is a PHP tool that allow enterprises to test employees' skills. Once the employee records his voice and answers the question that is shown on the screen, a specialized Octave code runs in the background and gives him a table of results based on some criteria.

It is fundamental to understand that this is not a final product, but a demonstration that good mathematical tools can aid enterprises to build powerful data analysis that go beyond big data. A lot of tools can be attached to this software to make analysis even more accurate.

## Criteria
Below you can see the list of criteria that are used to analyze employees' voices

Criteria             | Description
---------------------|--------------------------------------------------------------------------------------
Frequency            | Men and women with low voices tend to be more powerful and attractive. High pitched voices are penalized
Power                | Employees that are extremely loud or extremely silent are penalized
Frequency Variation  | Checks whether the frequency of the voice varies. Monotone voices are penalized.
Power Variation      | Checks whether the power of the voice varies. Monotone voices are penalized.
Semantic (Key Words) | The tool is able to understand which words are pronounced by the user, allowing to check whether the user is saying words that matter to the client.

## Screenshots
![Alt text](https://github.com/douglasrocha/WebSalesmanAnalysis/raw/master/doc/teste.png "Test")
![Alt text](https://github.com/douglasrocha/WebSalesmanAnalysis/raw/master/doc/resultado.png "Results")

## Git Page
- https://github.com/douglasrocha/WebSalesmanAnalysis
