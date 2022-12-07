import { PrismaClient } from "@prisma/client"

export interface global {}

declare global {
   var prisma: PrismaClient | undefined
}
