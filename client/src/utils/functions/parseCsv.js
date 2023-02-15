import Papa from 'papaparse'
import { fetchData } from './fetchData'

export const parseCsv = (csvFile, setter) => {
  Papa.parse(csvFile, {
    header: true,
    complete: (result) => {
      fetchData(result.data)
      setter(result.data)
    },
  })
}
