import { useRouter } from "next/router"
import { useEffect, useState } from "react"

const useRouterLoading = () => {
  const [routeChanging, setRouteChanging] = useState(false)
  const [progress, setProgress] = useState(0)
  const router = useRouter()

  useEffect(() => {
    router.events.on("routeChangeStart", () => {
      setRouteChanging(true)
      setTimeout(() => {
        setTimeout(() => {
          setProgress((prev) => prev + 1)
        }, 1)
      }, 1000)
    })
    router.events.on("routeChangeComplete", () => {
      setRouteChanging(false)
    })
  }, [router.events])

  return { routeChanging, progress }
}

export default useRouterLoading
