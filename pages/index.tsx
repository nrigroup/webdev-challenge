import { GetServerSideProps } from "next"
import dynamic from "next/dynamic"
import Head from "next/head"
import Image from "next/image"
import { useRouter } from "next/router"
import { useCallback, useMemo } from "react"
import { Button } from "react-bootstrap"
import server from "../clients/server"
import FileDropzone from "../components/FileDropzone"
import { BACKEND_URL } from "../config"
import styles from "../styles/Home.module.scss"

const BarRechartWithoutSSR = dynamic(import("../components/BarRechart"), { ssr: false })

const Home = ({ data }: { data: { data: { [key: string]: any }[] } }) => {
  const router = useRouter()
  const itemSalesData = useMemo(
    () =>
      data.data.map((itemSale) => {
        itemSale.date = new Date(itemSale.date).toDateString()
        return itemSale
      }),
    [data.data],
  )

  const refreshData = useCallback(() => {
    router.replace(router.asPath)
  }, [router])

  return (
    <div className={styles.container}>
      <Head>
        <title>Create Next App</title>
        <meta name="description" content="Generated by create next app" />
        <link rel="icon" href="/favicon.ico" />
      </Head>

      <main className={styles.main}>
        <BarRechartWithoutSSR data={itemSalesData} />
        <FileDropzone refreshData={refreshData} />
      </main>

      <footer className={styles.footer}>
        <a
          href="https://vercel.com?utm_source=create-next-app&utm_medium=default-template&utm_campaign=create-next-app"
          target="_blank"
          rel="noopener noreferrer">
          Powered by{" "}
          <span className={styles.logo}>
            <Image src="/vercel.svg" alt="Vercel Logo" width={72} height={16} />
          </span>
        </a>
      </footer>
    </div>
  )
}

export const getServerSideProps: GetServerSideProps = async ({ req, res }) => {
  res.setHeader("Cache-Control", "public, s-maxage=10, stale-while-revalidate=59")

  const response = await server.get(`${BACKEND_URL}/itemSales`)
  const data = response.data

  return { props: { data } }
}

export default Home
