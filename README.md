# NRI Web Development Challenge

## Environment set-up

Create ```.env``` file that matches ```.env.example``` with DATABASE_URL that points to a postgres database.

## Installation

```npm install``` to install dependencies.

```npx prisma db push``` to push the schema to psql.

```npx prisma generate``` to generate the prisma client.

```npm run dev``` to launch the app in development mode.

## Routes (/api-doc)

Visit /api-doc to view Swagger doc of api routes.

## Deployed version


https://nri-webdev-challenge.vercel.app


## Highlights

Planning out and building the schema of the database took some time, and I think one of the features I'm most proud of is the normalization of data by creating individual tables for almost all columns to attempt to reduce duplication of data. Another back end feature I'm proud of is the /itemSales GET route has been pushed to be as extensible as possible by accepting "order by", "direction", "limit", and "group by" query params.

I also wanted to make sure the front end interface was clean, simple, and built with Bootstrap components to adopt at least one piece of NRI's tech stack. It is responsive to all device sizes, and each of the components has been built to be as modular as possible so that they could be easily reused in other potential apps.