import randomColor from "randomcolor"
import { useMemo, useState } from "react"
import { Bar, BarChart, Cell, ResponsiveContainer, Tooltip, XAxis, YAxis } from "recharts"

const BarRechart = ({
  data,
  barDataKey,
  xAxisDataKey,
  xAxisLabel,
  barName,
  title,
}: {
  data?: { [key: string]: any }[]
  barDataKey: string
  xAxisDataKey: string
  xAxisLabel: string
  barName: string
  title: string
}) => {
  // const [hoverCellIndex, setHoverCellIndex] = useState<number | null>(null)
  const color = useMemo(() => {
    return randomColor({
      luminosity: "dark",
      format: "hsl",
    })
  }, [])
  return (
    <ResponsiveContainer minWidth={"50vw"} minHeight={"50vh"}>
      <BarChart data={data} title={title}>
        <Bar dataKey={barDataKey} name={barName}>
          {data &&
            data.map((entry, index) => {
              return (
                <Cell
                  key={`cell-${index}`}
                  fill={color}
                  // onMouseOver={() => {
                  //   setHoverCellIndex(index)
                  // }}
                  // onMouseLeave={() => {
                  //   setHoverCellIndex(null)
                  // }}
                />
              )
            })}
        </Bar>
        <XAxis dataKey={xAxisDataKey} fontSize="0.5rem" label={xAxisLabel} />
        <YAxis />
        <Tooltip formatter={(value, name, props) => `$${value}`} />
      </BarChart>
    </ResponsiveContainer>
  )
}

export default BarRechart
