export interface ItemSaleData {
  date: Date
  category: string
  auctionItem: string
  location: string
  condition: string
  preTaxAmount: number
  tax?: string
  taxAmount?: number
}
