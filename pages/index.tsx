import { GetServerSideProps } from "next"
import dynamic from "next/dynamic"
import Head from "next/head"
import Image from "next/image"
import { useRouter } from "next/router"
import { useCallback, useMemo } from "react"
import instance from "../lib/axios"
import FileDropzone from "../components/FileDropzone"
import { BACKEND_URL } from "../config"
import styles from "../styles/Home.module.scss"

const BarRechartWithoutSSR = dynamic(import("../components/BarRechart"), { ssr: false })
const PieRechartWithoutSSR = dynamic(import("../components/PieRechart"), { ssr: false })

const Home = ({
  totalSalesPerDay,
  totalSalesByCategory,
  totalSalesByCondition,
}: {
  totalSalesPerDay: { data: { [key: string]: any }[] }
  totalSalesByCategory: { data: { [key: string]: any }[] }
  totalSalesByCondition: { data: { [key: string]: any }[] }
}) => {
  const router = useRouter()
  const totalSalesPerDayData = useMemo(
    () =>
      totalSalesPerDay.data.map((row) => {
        row.date = new Date(row.date).toLocaleDateString("en-US")
        return row
      }),
    [totalSalesPerDay.data],
  )

  const totalSalesByCategoryData = useMemo(
    () =>
      totalSalesByCategory.data.map((row) => {
        if (row._sum.preTaxAmount) {
          row._sum.preTaxAmount = parseFloat(row._sum.preTaxAmount as unknown as string)
        }
        return row
      }),
    [totalSalesByCategory.data],
  )

  const totalSalesByConditionData = useMemo(
    () =>
      totalSalesByCondition.data.map((row) => {
        if (row._sum.preTaxAmount) {
          row._sum.preTaxAmount = parseFloat(row._sum.preTaxAmount as unknown as string)
        }
        return row
      }),
    [totalSalesByCondition.data],
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
        <BarRechartWithoutSSR
          data={totalSalesPerDayData}
          barDataKey="_sum.preTaxAmount"
          barName="Total"
          xAxisDataKey="date"
          xAxisLabel="Day"
          title="Pre-Tax Amount Totals By Day"
        />
        <PieRechartWithoutSSR
          data={totalSalesByCategoryData}
          dataKey="_sum.preTaxAmount"
          nameKey="category.name"
          title="Pre-Tax Amount Totals By Item Category"
        />
        <PieRechartWithoutSSR
          data={totalSalesByConditionData}
          dataKey="_sum.preTaxAmount"
          nameKey="condition.description"
          title="Pre-Tax Amount Totals By Item Condition"
        />
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

  const { data: totalSalesPerDay } = await instance.get(`${BACKEND_URL}/itemSales`, {
    params: {
      groupBy: "date",
      orderBy: "date",
      sum: "preTaxAmount",
    },
  })

  const { data: totalSalesByCategory } = await instance.get(`${BACKEND_URL}/categories/totalSales`)

  const { data: totalSalesByCondition } = await instance.get(`${BACKEND_URL}/conditions/totalSales`)

  return {
    props: {
      totalSalesPerDay,
      totalSalesByCategory,
      totalSalesByCondition,
    },
  }
}

export default Home
