# Created Virtual envv

# Use ESLint to maintain Airbnb and Python style guide

# Architecture

1. I am chosing a microservice type of architecture from a scalability point of view : One microservice would have frontend and other backend. This archtecture also helps because I am chossing a different stack for frontend(React) and backend(Django). Loose coupling is also an inspiration. This is still a mono-repo thing so as I could submit the work in one repo, however, for larger scale this should have been ideally polyrepo. The challenge here is :
1. How can I deploy these for development easily: May be make a separate branch for frontend and backend?
1. How can I deploy these in production easily: May be use a single docker file in root if single server deployment or use separate docker files in each and deploy on separate servers.
1. How can I test these easily: Make separate workflows for each branch?
1. How can I manage linters for each:

# Features:
1.Uses SASS
2. Uses Linting for javascript and python
3. Builds an MVC architecture with microservices implemented by separating frontend and backend.
4.Code is extensible
5. Code is high quality.
6. Uses bootstrap
7. USes guard clauses
8. USes mostly functional programming style and pure functions.
9. Uses jest for testing React code
10. Uses context api to provide data and methods to various routes