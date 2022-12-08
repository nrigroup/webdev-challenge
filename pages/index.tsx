import { GetServerSideProps, GetServerSidePropsContext } from "next"
import dynamic from "next/dynamic"
import Head from "next/head"
import { useCallback, useState } from "react"
import FileDropzone from "../components/FileDropzone"
import styles from "../styles/Home.module.scss"
import { withCSR } from "../utils/withCSR"
import { dehydrate, QueryClient } from "@tanstack/react-query"
import { get } from "../utils"
import CSVFileValidator, { RowError } from "csv-file-validator"
import { itemSaleFileParseConfig } from "../lib/csv-file-validator"
import { ItemSaleData, REQUEST_STATUS } from "../types"
import useHomeData from "../hooks/useHomeData"
import { tickFormatter, tooltipFormatter } from "../utils/recharts"

const BarRechartWithoutSSR = dynamic(import("../components/BarRechart"), { ssr: false })
const PieRechartWithoutSSR = dynamic(import("../components/PieRechart"), { ssr: false })

const Home = () => {
  const [fileName, setFileName] = useState<null | string>(null)
  const [fileErrors, setFileErrors] = useState<(RowError | { message: string })[]>([])
  const [mutationStatus, setMutationStatus] = useState(REQUEST_STATUS.IDLE)
  const [data, setData] = useState<null | ItemSaleData[]>(null)

  const {
    addItemSales,
    totalSalesPerDay,
    totalSalesPerDayData,
    totalSalesByCategory,
    totalSalesByCategoryData,
    totalSalesByCondition,
    totalSalesByConditionData,
  } = useHomeData()

  const refreshData = useCallback(() => {
    totalSalesPerDay.refetch()
    totalSalesByCategory.refetch()
    totalSalesByCondition.refetch()
  }, [totalSalesPerDay, totalSalesByCategory, totalSalesByCondition])

  const onDrop = useCallback(async (acceptedFiles: File[]) => {
    try {
      const { data, inValidData } = await CSVFileValidator(
        acceptedFiles[0],
        itemSaleFileParseConfig,
      )

      setFileErrors(inValidData)
      setData(data)
      setFileName(acceptedFiles[0].name)
    } catch (error) {
      // error with file parsing
      setFileErrors([{ message: "There was an issue with parsing the data file" }])
    }
  }, [])

  const onSubmit = useCallback(async () => {
    setMutationStatus(REQUEST_STATUS.FETCHING)
    try {
      await addItemSales.mutateAsync(data!)
      setMutationStatus(REQUEST_STATUS.SUCCESS)
      refreshData()
    } catch (error) {
      setMutationStatus(REQUEST_STATUS.ERROR)
      console.log(error)
    }
  }, [addItemSales, refreshData, data])

  return (
    <div className={styles.container}>
      <Head>
        <title>NRI Web Dev Challenge</title>
        <meta name="description" content="Dusty Luck's web app for NRI's Web Dev Challenge." />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <main className={styles.main}>
        <h1>NRI Web Dev Challenge</h1>
        {totalSalesPerDayData && totalSalesPerDayData.length > 0 && (
          <BarRechartWithoutSSR
            data={totalSalesPerDayData}
            barDataKey="_sum.preTaxAmount"
            barName="Total"
            xAxisDataKey="date"
            title="Pre-Tax Amount Totals By Day"
            tooltipFormatter={tooltipFormatter}
            tickFormatter={tickFormatter}
          />
        )}
        <section className={styles.pieCharts}>
          {totalSalesByCategoryData && totalSalesByCategoryData.length > 0 && (
            <PieRechartWithoutSSR
              data={totalSalesByCategoryData}
              dataKey="_sum.preTaxAmount"
              nameKey="category.name"
              title="Pre-Tax Amount Totals By Item Category"
              tooltipFormatter={tooltipFormatter}
              tickFormatter={tickFormatter}
            />
          )}
          {totalSalesByConditionData && totalSalesByConditionData.length > 0 && (
            <PieRechartWithoutSSR
              data={totalSalesByConditionData}
              dataKey="_sum.preTaxAmount"
              nameKey="condition.description"
              title="Pre-Tax Amount Totals By Item Condition"
              tooltipFormatter={tooltipFormatter}
              tickFormatter={tickFormatter}
            />
          )}
        </section>
        <FileDropzone
          onDrop={onDrop}
          onSubmit={onSubmit}
          fileType=".csv"
          fileName={fileName}
          fileErrors={fileErrors}
          mutationStatus={mutationStatus}
          removeFile={() => {
            setFileName(null)
          }}
        />
      </main>

      <footer className={styles.footer}>
        <span>Designed and developed by:</span>
        <a href="https://dluck.vercel.app" target="_blank" rel="noopener noreferrer">
          Dusty Luck
        </a>
      </footer>
    </div>
  )
}

export const getServerSideProps: GetServerSideProps = withCSR(
  async (ctx: GetServerSidePropsContext) => {
    const queryClient = new QueryClient()

    await queryClient.prefetchQuery(["itemSalesDailyTotals"], () =>
      get({
        route: "/itemSales",
        params: {
          groupBy: "date",
          orderBy: "date",
          sum: "preTaxAmount",
        },
      }),
    )

    await queryClient.prefetchQuery(["categoriesTotalSales"], () =>
      get({ route: "/categories/totalSales" }),
    )
    await queryClient.prefetchQuery(["conditionsTotalSales"], () =>
      get({ route: "/conditions/totalSales" }),
    )

    return {
      props: {
        dehydratedState: dehydrate(queryClient),
      },
    }
  },
)

export default Home
