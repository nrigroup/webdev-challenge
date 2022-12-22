## How I built this

I used React to build this app because its something I have been learning and trying to improve on. I knew React had a lot of use libraries for charts and parsing data. I used npm to install the "Papa Parse" library to parse the data from the uploaded CSV file. From there I used the parsed data and plugged into another library called "Recharts" which visualizes the data into charts.

## What I'm proud to accomplish

I'm proud that I was able to do something different with React than I am used to. Mainly having used it for frontend and UI, this was a different usecase and I learned a lot throughout the process in terms of connecting the frontend to the backend(node.js). Although I wasn't able to fulfill the requirements of the project, I still wanted to visualize the data from the example .csv file and I was able to do that with React.

## Time

I set out on this project with a good outline of how I would parse the data and store it into RDB, I tried Amazon RDS and was not able to get the code to work. I spent a lot of time trying to use node.js and packages like multer, cors, etc. to connect the project together but was unsuccessful. Nonetheless, this project exposed me to topics I need to improve on and I am glad I gave it a try.

## Bar Graph

The bar graph is set to show the first column of the csv file on the x-axis and the sixth column on the y-axis. For future improvements, I would like to remove the manual column identities and make the graphs return a specific column name. That way, no matter what order the columns are in, it will show the correct data.
