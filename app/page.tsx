import Image from "next/image"
import Link from "next/link"
import { ChevronDown } from "lucide-react"

export default function Home() {
  return (
    <div className="min-h-screen bg-gradient-to-b from-dark-blue via-dark-blue to-purple-blue">
      {/* Navigation */}
      <header className="container mx-auto px-4 py-4 flex justify-between items-center">
        <Link href="/" className="text-white text-2xl font-bold">
          EcoTrack
        </Link>
        <nav className="hidden md:flex items-center gap-6">
          <Link href="/" className="text-white hover:text-gray-300">
            Home
          </Link>
          <div className="relative group">
            <button className="flex items-center gap-1 text-white hover:text-gray-300">
              Explore Eco Track
              <ChevronDown className="h-4 w-4" />
            </button>
          </div>
          <Link href="/laporkan-titik" className="text-white hover:text-gray-300">
            Laporkan Titik
          </Link>
          <Link href="/about-us" className="text-white hover:text-gray-300">
            About Us
          </Link>
        </nav>
        <div className="flex items-center gap-2">
          <Link href="/login" className="text-white hover:text-gray-300">
            Login
          </Link>
          <Link
            href="/signup"
            className="bg-transparent border border-white text-white px-4 py-1 rounded-full hover:bg-white hover:text-dark-blue transition-colors"
          >
            Sign Up
          </Link>
        </div>
      </header>

      {/* Hero Section */}
      <section className="container mx-auto px-4 py-16 text-center relative z-10">
        <h1 className="text-4xl md:text-5xl font-bold text-white mb-4">EcoTrack untuk Masa Depan Bebas Sampah</h1>
        <p className="text-white text-lg mb-8 max-w-3xl mx-auto">
          "Bersama EcoTrack, wujudkan pengelolaan sampah berkelanjutan di Indonesia."
        </p>
        <Link
          href="/peta"
          className="inline-block bg-transparent border border-white text-white px-6 py-2 rounded-full hover:bg-white hover:text-dark-blue transition-colors"
        >
          Lihat Peta
        </Link>
      </section>

      {/* Earth Image */}
      <div className="relative w-full h-[300px] md:h-[400px] overflow-hidden">
        <Image
          src="/placeholder.svg?height=400&width=1200"
          alt="Earth view from space"
          fill
          className="object-cover"
          priority
        />
      </div>

      {/* Image Gallery */}
      <div className="container mx-auto px-4 -mt-16 relative z-20 flex justify-center">
        <div className="grid grid-cols-3 gap-4 max-w-4xl">
          <div className="col-span-1">
            <Image
              src="/placeholder.svg?height=200&width=300"
              alt="Waste management truck"
              width={300}
              height={200}
              className="rounded-lg object-cover h-full"
            />
          </div>
          <div className="col-span-1 transform translate-y-8">
            <Image
              src="/placeholder.svg?height=250&width=350"
              alt="Beach cleanup activity"
              width={350}
              height={250}
              className="rounded-lg object-cover h-full"
            />
          </div>
          <div className="col-span-1">
            <Image
              src="/placeholder.svg?height=200&width=300"
              alt="Community waste collection"
              width={300}
              height={200}
              className="rounded-lg object-cover h-full"
            />
          </div>
        </div>
      </div>

      {/* Core Features */}
      <section className="container mx-auto px-4 py-24 text-center">
        <h2 className="text-3xl font-bold text-white mb-4">Core Features</h2>
        <p className="text-white text-lg mb-16 max-w-2xl mx-auto">
          Empowering communities with innovative tools for waste management and environmental protection
        </p>

        {/* Feature 1 */}
        <div className="grid md:grid-cols-2 gap-8 items-center mb-24">
          <div className="text-left">
            <h3 className="text-2xl font-bold text-white mb-4">Peta Interaktif</h3>
            <p className="text-white mb-6">
              Eksplorasi lokasi bank sampah, tempat pembuangan akhir (TPA), dan laporan titik sampah liar di seluruh
              Indonesia dengan peta real-time yang mudah digunakan. Temukan solusi pengelolaan sampah terdekat hanya
              dalam satu klik.
            </p>
            <Link
              href="/map"
              className="inline-block bg-transparent border border-white text-white px-6 py-2 rounded-full hover:bg-white hover:text-dark-blue transition-colors"
            >
              EcoTrack Map
            </Link>
          </div>
          <div>
            <Image
              src="/placeholder.svg?height=300&width=500"
              alt="Interactive map feature"
              width={500}
              height={300}
              className="rounded-lg"
            />
          </div>
        </div>

        {/* Feature 2 */}
        <div className="grid md:grid-cols-2 gap-8 items-center mb-24">
          <div className="md:order-2 text-left">
            <h3 className="text-2xl font-bold text-white mb-4">Pelaporan Titik Sampah Cepat</h3>
            <p className="text-white mb-6">
              Laporkan keberadaan sampah liar di lingkungan sekitar Anda secara langsung melalui form interaktif
              berbasis peta. Kontribusi Anda akan membantu pemerintah dan komunitas mengambil tindakan lebih cepat dan
              tepat.
            </p>
            <Link
              href="/report"
              className="inline-block bg-transparent border border-white text-white px-6 py-2 rounded-full hover:bg-white hover:text-dark-blue transition-colors"
            >
              EcoTrack Report
            </Link>
          </div>
          <div className="md:order-1">
            <Image
              src="/placeholder.svg?height=300&width=500"
              alt="Waste reporting feature"
              width={500}
              height={300}
              className="rounded-lg"
            />
          </div>
        </div>

        {/* Feature 3 */}
        <div className="grid md:grid-cols-2 gap-8 items-center mb-24">
          <div className="text-left">
            <h3 className="text-2xl font-bold text-white mb-4">Dashboard Data untuk Pemerintah & Mitra</h3>
            <p className="text-white mb-6">
              Akses dashboard pintar berisi statistik laporan, heatmap wilayah kritis, dan kinerja penanganan sampah.
              EcoTrack mendukung dinas lingkungan dan mitra daur ulang dalam mengambil keputusan berbasis data yang
              akurat.
            </p>
            <Link
              href="/dashboard"
              className="inline-block bg-transparent border border-white text-white px-6 py-2 rounded-full hover:bg-white hover:text-dark-blue transition-colors"
            >
              EcoTrack Dashboard
            </Link>
          </div>
          <div>
            <Image
              src="/placeholder.svg?height=300&width=500"
              alt="Data dashboard feature"
              width={500}
              height={300}
              className="rounded-lg"
            />
          </div>
        </div>

        {/* Feature 4 */}
        <div className="grid md:grid-cols-2 gap-8 items-center">
          <div className="md:order-2 text-left">
            <h3 className="text-2xl font-bold text-white mb-4">Kolaborasi Ekosistem Lingkungan</h3>
            <p className="text-white mb-6">
              EcoTrack menghubungkan masyarakat, pemerintah daerah, dan UMKM daur ulang dalam satu platform kolaboratif.
              Bersama, kita mempercepat terciptanya sistem pengelolaan sampah yang berkelanjutan dan memberdayakan
              ekonomi lokal.
            </p>
            <Link
              href="/collaboration"
              className="inline-block bg-transparent border border-white text-white px-6 py-2 rounded-full hover:bg-white hover:text-dark-blue transition-colors"
            >
              EcoTrack Collaboration
            </Link>
          </div>
          <div className="md:order-1">
            <Image
              src="/placeholder.svg?height=300&width=500"
              alt="Ecosystem collaboration feature"
              width={500}
              height={300}
              className="rounded-lg"
            />
          </div>
        </div>
      </section>
    </div>
  )
}
