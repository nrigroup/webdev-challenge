/*
* inbuilt / framework imports
* */
import React from 'react'


/*
* Importing third party components
* OPEN SOURCE
* */
import { Spin } from 'antd';


/*
* Importing custom libraries
* */
import Theme from "../utils/Theme.js";

const Loading = () => {
  const theme = new Theme();
  console.log(theme.DetectWindowTheme());
  return <div className={"center-child loading"}>
    <Spin size={"large"}/>
    <p>Loading...</p>
  </div>
}

export default Loading;