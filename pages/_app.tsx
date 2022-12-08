import "../styles/globals.scss"
import type { AppProps } from "next/app"
import { useState } from "react"
import { Hydrate, QueryClient, QueryClientProvider } from "@tanstack/react-query"
import { config } from "../lib/react-query-config"
import { ProgressBar } from "react-bootstrap"
import useRouterLoading from "../hooks/useRouterLoading"

export default function App({ Component, pageProps }: AppProps) {
  const [queryClient] = useState(() => new QueryClient(config))
  const { routeChanging, progress } = useRouterLoading()

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
