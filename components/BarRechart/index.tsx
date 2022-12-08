import randomColor from "randomcolor"
import { useMemo, useState } from "react"
import { Bar, BarChart, Cell, Label, ResponsiveContainer, Tooltip, XAxis, YAxis } from "recharts"
import styles from "./index.module.scss"

const BarRechart = ({
  data,
  barDataKey,
  xAxisDataKey,
  xAxisLabel,
  barName,
  title,
  tooltipFormatter,
  tickFormatter,
}: {
  data?: { [key: string]: any }[]
  barDataKey: string
  xAxisDataKey: string
  xAxisLabel?: string
  barName: string
  title: string
  tooltipFormatter: (value: string, name: string, props: any) => string
  tickFormatter: (value: string, index: number) => string
}) => {
  const color = useMemo(() => {
    return randomColor({
      luminosity: "dark",
      format: "hsl",
    })
  }, [])
  return (
    <div className={styles.container}>
      <h2>{title}</h2>
      <ResponsiveContainer className={styles.responsiveContainer}>
        <BarChart data={data} title={title}>
          <Bar dataKey={barDataKey} name={barName}>
            {data &&
              data.map((entry, index) => {
                return <Cell key={`cell-${index}`} fill={color} />
              })}
          </Bar>
          <XAxis dataKey={xAxisDataKey} fontSize="0.8rem">
            <Label value={xAxisLabel} offset={0} position="insideBottom" />
          </XAxis>
          <YAxis tickFormatter={tickFormatter} padding={{ top: 5 }} />
          <Tooltip formatter={tooltipFormatter} />
        </BarChart>
      </ResponsiveContainer>
    </div>
  )
}

export default BarRechart
