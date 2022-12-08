import "../styles/globals.scss"
import type { AppProps } from "next/app"
import { useEffect, useState } from "react"
import { Hydrate, QueryClient, QueryClientProvider } from "@tanstack/react-query"
import { config } from "../lib/react-query-config"
import { useRouter } from "next/router"
import { ProgressBar } from "react-bootstrap"

export default function App({ Component, pageProps }: AppProps) {
  const [routeChanging, setRouteChanging] = useState(false)
  const [progress, setProgress] = useState(0)
  const [queryClient] = useState(() => new QueryClient(config))
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

  return (
    <QueryClientProvider client={queryClient}>
      <Hydrate state={pageProps.dehydratedState}>
        {routeChanging ? (
          <ProgressBar
            animated
            max={1000}
            now={progress}
            style={{ marginTop: "48vh", width: "80vw", marginLeft: "10vw" }}
          />
        ) : (
          <Component {...pageProps} />
        )}
      </Hydrate>
    </QueryClientProvider>
  )
}
