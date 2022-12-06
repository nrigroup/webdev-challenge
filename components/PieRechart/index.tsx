import { Cell, Legend, Pie, PieChart, Tooltip } from "recharts"
import randomColor from "randomcolor"
import { useMemo, useState } from "react"

const PieRechart = ({
  data,
  dataKey,
  nameKey,
  title,
}: {
  data: { [key: string]: any }[]
  dataKey: string
  nameKey: string
  title: string
}) => {
  // const [hoverCellIndex, setHoverCellIndex] = useState<number | null>(null)
  const colors = useMemo(() => {
    return randomColor({
      count: data.length,
      luminosity: "dark",
      format: "hsl",
    })
  }, [data.length])

  return (
    <PieChart width={500} height={500} title={title}>
      <Pie
        dataKey={dataKey}
        data={data}
        nameKey={nameKey}
        label={(props) => {
          const { value } = props
          return <text {...props}>{"$" + value}</text>
        }}
        legendType="circle">
        {data.map((entry, index) => {
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
  )
}

export default PieRechart
