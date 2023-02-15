import Alert from "react-bootstrap/Alert";

export default function NriAlert({ variant, text }) {
  return <Alert variant={variant}>{text}</Alert>;
}

NriAlert.defaultProps = {
  variant: "danger",
  text: "Something went wrong",
};
