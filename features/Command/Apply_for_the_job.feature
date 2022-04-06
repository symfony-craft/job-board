Feature:

  Background:
    Given these companies are registered :
      | id | name       | email                  |
      | 1  | SensioLabs | contact@sensiolabs.com |

  Scenario: apply to an existing job
    Given these jobs are registered :
      | id | companyId | title                    | description                                                     |
      | 1  | 1         | Senior Symfony developer | We are looking for a senior symfony developer with craft skills |
    When I apply for the job "1" with the email "etienne@lebarillier.fr"
    Then these applicants should be registered :
      | email                  | applications |
      | etienne@lebarillier.fr | 1            |

  Scenario: apply to an existing job that we already apply for
    Given these applicants are registered :
      | email                  | applications |
      | etienne@lebarillier.fr | 1            |
    Given these jobs are registered :
      | id | companyId | title                    | description                                                     |
      | 1  | 1         | Senior Symfony developer | We are looking for a senior symfony developer with craft skills |
    When I apply for the job "1" with the email "etienne@lebarillier.fr"
    Then these applicants should be registered :
      | email                  | applications |
      | etienne@lebarillier.fr | 1            |
