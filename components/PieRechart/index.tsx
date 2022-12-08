import { Cell, Legend, Pie, PieChart, ResponsiveContainer, Tooltip } from "recharts"
import randomColor from "randomcolor"
import { useMemo, useState } from "react"
import styles from "./index.module.scss"

const PieRechart = ({
  data,
  dataKey,
  nameKey,
  title,
  tooltipFormatter,
  tickFormatter,
}: {
  data?: { [key: string]: any }[]
  dataKey: string
  nameKey: string
  title: string
  tooltipFormatter: (value: string, name: string, props: any) => string
  tickFormatter: (value: string, index?: number) => string
}) => {
  const colors = useMemo(() => {
    return randomColor({
      count: data?.length ? data.length : 1,
      luminosity: "dark",
      format: "hsl",
    })
  }, [data?.length])

  return (
    <div className={styles.container}>
      <h2>{title}</h2>
      <ResponsiveContainer className={styles.responsiveContainer}>
        <PieChart title={title}>
          <Pie
            dataKey={dataKey}
            data={data}
            nameKey={nameKey}
            label={({ cx, cy, midAngle, innerRadius, outerRadius, value, fill }) => {
              const RADIAN = Math.PI / 180
              const radius = 25 + innerRadius + (outerRadius - innerRadius)
              const x = cx + radius * Math.cos(-midAngle * RADIAN)
              const y = cy + radius * Math.sin(-midAngle * RADIAN)

              return (
                <text
                  x={x}
                  y={y}
                  fill={fill}
                  textAnchor={x > cx ? "start" : "end"}
                  dominantBaseline="central">
                  {tickFormatter(value)}
                </text>
              )
            }}
            legendType="circle">
            {data &&
              data.map((entry, index) => {
                return <Cell key={`cell-${index}`} fill={colors[index]} stroke={colors[index]} />
              })}
          </Pie>
          <Legend wrapperStyle={{ display: "flex", justifyContent: "center" }} />
          <Tooltip formatter={tooltipFormatter} />
        </PieChart>
      </ResponsiveContainer>
    </div>
  )
}

export default PieRechart
