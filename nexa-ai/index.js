
const express = require("express");
const cors = require("cors");
const tf = require("@tensorflow/tfjs");

const app = express();

app.use(cors({
  origin: [
    "https://nexasubmit-production.up.railway.app"
  ],
  methods: ["GET", "POST"],
  allowedHeaders: ["Content-Type", "Authorization"]
}));

app.use(express.json({ limit: "20kb" }));

app.get("/", (req, res) => {
  res.json({
    name: "NEXA AI",
    status: "online",
    engine: "TensorFlow.js"
  });
});

app.get("/api/status", (req, res) => {
  res.json({
    name: "NEXA AI",
    status: "ready",
    tensorflow: tf.version.tfjs
  });
});

app.post("/api/chat", (req, res) => {
  const message = String(req.body.message || "").trim();

  if (!message) {
    return res.status(400).json({
      reply: "Tulis pertanyaan terlebih dahulu."
    });
  }

  if (message.length > 4000) {
    return res.status(413).json({
      reply: "Pesan terlalu panjang."
    });
  }

  const text = message.toLowerCase();
  let reply;

  if (/\b(halo|hai|hello)\b/.test(text)) {
    reply = "Halo! Gue NEXA AI. Ada yang mau lu tanyakan?";
  } else if (text.includes("nama")) {
    reply = "Gue NEXA AI, asisten yang sedang dikembangkan.";
  } else {
    reply = "Gue menerima pesan lu, tetapi model bahasa gue belum dilatih untuk menjawab pertanyaan secara luas.";
  }

  res.json({ reply });
});

const PORT = process.env.PORT || 3000;

app.listen(PORT, "0.0.0.0", () => {
  console.log(`NEXA AI berjalan di port ${PORT}`);
});
