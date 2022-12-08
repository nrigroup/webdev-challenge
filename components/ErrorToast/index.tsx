import Image from "next/image"
import { useState } from "react"
import { Toast } from "react-bootstrap"

const ErrorToast = ({ message, updatedAt }: { message: string; updatedAt: string }) => {
  const [show, setShow] = useState(true)
  return (
    <Toast onClose={() => setShow(false)} show={show} delay={5000} autohide>
      <Toast.Header>
        <Image
          src="https://img.icons8.com/fluency/48/null/medium-risk.png"
          alt="warning"
          width={48}
          height={48}
          style={{ height: "2rem", width: "2rem", marginRight: "0.25rem" }}
        />
        <strong className="me-auto">Error</strong>
        <small>{updatedAt}</small>
      </Toast.Header>
      <Toast.Body>{message}</Toast.Body>
    </Toast>
  )
}

export default ErrorToast
