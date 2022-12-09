import dynamic from "next/dynamic"
import "swagger-ui-react/swagger-ui.css"
import spec from "../swagger.json"

const SwaggerUI = dynamic(import("swagger-ui-react"), { ssr: false })

const ApiDoc = () => <SwaggerUI spec={spec} />

export default ApiDoc
