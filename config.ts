export let BACKEND_URL = "http://localhost:3000/api"

if (process.env.NEXT_PUBLIC_ENV === "production") {
  BACKEND_URL = "https://nri-webdev-challenge.vercel.app/api"
}
