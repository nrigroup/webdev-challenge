import { Cell, Legend, Pie, PieChart, ResponsiveContainer, Tooltip } from "recharts"
import randomColor from "randomcolor"
import { useMemo, useState } from "react"

const PieRechart = ({
  data,
  dataKey,
  nameKey,
  title,
}: {
  data?: { [key: string]: any }[]
  dataKey: string
  nameKey: string
  title: string
}) => {
  // const [hoverCellIndex, setHoverCellIndex] = useState<number | null>(null)
  const colors = useMemo(() => {
    return randomColor({
      count: data?.length ? data.length : 1,
      luminosity: "dark",
      format: "hsl",
    })
  }, [data?.length])

  return (
    <ResponsiveContainer minHeight={"50vh"}>
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
                {`$${value}`}
              </text>
            )
          }}
          legendType="circle">
          {data &&
            data.map((entry, index) => {
              return (
                <Cell
                  key={`cell-${index}`}
                  fill={colors[index]}
                  stroke={colors[index]}
                  // strokeWidth={index === hoverCellIndex ? 4 : 1}
                  // onMouseOver={() => {
                  //   setHoverCellIndex(index)
                  // }}
                  // onMouseLeave={() => {
                  //   setHoverCellIndex(null)
                  // }}
                />
              )
            })}
        </Pie>
        <Legend />
        <Tooltip formatter={(value, name, props) => `$${value}`} />
      </PieChart>
    </ResponsiveContainer>
  )
}

export default PieRechart
