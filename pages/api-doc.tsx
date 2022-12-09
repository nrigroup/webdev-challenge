import dynamic from "next/dynamic"
import "swagger-ui-react/swagger-ui.css"

const SwaggerUI = dynamic(import("swagger-ui-react"), { ssr: false })

const ApiDoc = () => (
  <SwaggerUI url="https://stoplight.io/api/v1/projects/dusty-luck/nri-webdev-challenge/nodes/swagger.json?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJodHRwczovL3N0b3BsaWdodC5pby9qd3QvY2xhaW1zIjp7IngtaGFzdXJhLWRlZmF1bHQtcm9sZSI6IndvcmtzcGFjZV91c2VyIiwieC1oYXN1cmEtYWxsb3dlZC1yb2xlcyI6WyJ3b3Jrc3BhY2VfdXNlciJdLCJ4LWhhc3VyYS11c2VyLWlkIjoiMjA1Mjc3IiwieC1oYXN1cmEtdXNlci1pcC1hZGRyZXNzIjoiMzUuMTkxLjguMzQiLCJ4LWhhc3VyYS13b3Jrc3BhY2UtaWQiOiIxMTg0ODEifSwiaWF0IjoxNjcwNjE3NTUyLCJleHAiOjE2NzA2MjExNTIsImlzcyI6InN0b3BsaWdodCIsInN1YiI6Ii91c2Vycy8yMDUyNzcifQ.Dbqo65rLjZGDAAQ7e_wyMu81VUJsgAe88xyEweaiQeQ&_ga=2.196244972.1951064738.1670615472-1187916952.1670615472" />
)

export default ApiDoc
