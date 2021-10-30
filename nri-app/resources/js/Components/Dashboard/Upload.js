import React from "react";
import Input from "../Input";
import { useFormik } from "formik";

export default function Upload() {
  const formik = useFormik({
    initialValues: {
      file: ""
    },
    validate: values => {
      const errors = {};
      if (!values.file) {
        errors.file = "Please select a data file to upload.";
      }
      return errors;
    },
    onSubmit: values => {
      console.log(values);
    }
  });

  return <div className="py-12">
    <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div className="p-6 bg-white border-b border-gray-200">
          <form onSubmit={formik.handleSubmit}>
            <div>
              <Input type="file"
                name="file"
                handleChange={formik.handleChange}
                value={formik.values.file} />
              {formik.touched.file && formik.errors.file ? <div>{formik.errors.file}</div> : null}
            </div>
            <div className="px-6 pt-4 pb-2">
              <button className="btn btn-blue" type="submit">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
}