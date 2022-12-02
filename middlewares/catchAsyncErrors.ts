import { NextApiRequest, NextApiResponse } from "next"

const catchAsyncErrors =
  (func: any) => (req: NextApiRequest, res: NextApiResponse, next: () => void) =>
    Promise.resolve(func(req, res, next)).catch(next)

export default catchAsyncErrors
