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

export enum ItemSaleRelation {
  auctionItem = "auctionItem",
  category = "category",
  location = "location",
  tax = "tax",
  condition = "condition",
}

export enum REQUEST_STATUS {
	FETCHING,
	IDLE,
	SUCCESS,
	ERROR,
}
