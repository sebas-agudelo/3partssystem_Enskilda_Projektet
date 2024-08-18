
import express from "express";
import cors from "cors";
import { config } from "dotenv";
import mongoose from "mongoose";
import { router } from "./router/productsRouter.js";

const app = express();
app.use(express.json());
app.use(
  cors({
    origin: ["http://localhost:8000"],
    credentials: true,
  })
);
app.use(express.urlencoded({ extended: true }));
config();

app.use(router);

const MONGOOSE_URL = process.env.MONGO_URL;
const PORT = process.env.PORT || 3000;

mongoose
  .connect(MONGOOSE_URL)
  .then(() => {
    console.log("Database is connected successfylly");

    app.listen(PORT, () => {
      console.log(`Server is running on port ${PORT}`);
    });
  })
  .catch((err) => console.log(err));
