<x-base-layout>
    <a href="/">
        <x-application-logo class="h-20 fill-current text-gray-500" />
    </a>
    <div class="container grid md:grid-cols-2 mt-4">
        <div>
            <img class="m-auto" src="{{asset('image 10.png')}}">
        </div>
        <div class="bg-content-dark/20 p-4 grid place-content-center">
            โปรแกรมปกป้องสุนัขจากปรสิตตัวร้ายที่สัตวแพทย์แนะนำเป็นประจำทุกเดือน 
            ซึ่งถูกออกแบบมาเพื่อสุนัขโดยเฉพาะ เพื่อคนรักสุนัขยุคใหม่ กับ “พลังปกป้องถึง 3 ชั้น” ได้แก่ พยาธิหนอนหัวใจ, หมัด-เห็บ, พยาธิทางเดินอาหาร
            ปกป้องน้องหมาจากปรสิตร้ายที่อันตรายถึงชีวิตไปกับ Super TRIO
        </div>
    </div>

    <main class="container m-auto py-16">
        <livewire:client-register />
    </main>
    <div class="container grid md:grid-cols-2 mt-4">
        <div class="bg-content-dark/20 grid place-content-center">
            <iframe src="https://www.youtube.com/embed/4WHGfONNDM4?si=O32zKrvy87v97Rgd" 
            class="w-full h-auto aspect-video"
            title="YouTube video player" frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
            allowfullscreen></iframe>
        </div>
        <div class="bg-content-dark/20 grid place-content-center">
            <div class="grid grid-cols-3 p-2 gap-2">
                <div>
                    <img src="{{asset('a1.jpg')}}">
                    <span class="bg-primary-blue p-2 text-xs font-thin text-secondary-100 block w-max">เคล็ดลับปกป้อง</span>
                    <h3 class="text-xl"><a href="https://www.supertriodog.com/%e0%b8%9e%e0%b8%a2%e0%b8%b2%e0%b8%98%e0%b8%b4%e0%b8%ab%e0%b8%99%e0%b8%ad%e0%b8%99%e0%b8%ab%e0%b8%b1%e0%b8%a7%e0%b9%83%e0%b8%88/">“พยาธิหนอนหัวใจ”</a></h3>
                    <p>
                        ปรสิตตัวร้ายที่สัตวแพทย์เตือนนัก เตือนหนาว่ามีความอันตรายร้ายแรง แถมยังติดง่ายเพียงการโดนยุงกัดแค่ครั้งเดียว
อันตรายจากพยาธิหนอนหัวใจจะมากมายแค่ไหนกันนะ ? ไปหาคำตอบพร้อมกันได้เลย !
                    </p>
                    <span><a href="https://www.supertriodog.com/%e0%b8%9e%e0%b8%a2%e0%b8%b2%e0%b8%98%e0%b8%b4%e0%b8%ab%e0%b8%99%e0%b8%ad%e0%b8%99%e0%b8%ab%e0%b8%b1%e0%b8%a7%e0%b9%83%e0%b8%88/">อ่านต่อ</a></span>
                </div>
                <div>
                    <img src="{{asset('a2.jpg')}}">
                    <span class="bg-primary-blue p-2 text-xs font-thin text-secondary-100 block w-max">เคล็ดลับปกป้อง</span>
                    <h3 class="text-xl"><a href="https://www.supertriodog.com/%e0%b9%80%e0%b8%ab%e0%b9%87%e0%b8%9a%e0%b8%81%e0%b8%b1%e0%b8%94%e0%b8%a3%e0%b8%b0%e0%b8%a7%e0%b8%b1%e0%b8%87%e0%b8%9e%e0%b8%a2%e0%b8%b2%e0%b8%98%e0%b8%b4%e0%b9%80%e0%b8%a1%e0%b9%87%e0%b8%94%e0%b9%80/">เห็บกัดระวังพยาธิเม็ดเลือด !</a></h3>
                    <p>
                        โรคร้ายที่แฝงมากับเห็บ ปล่อยไว้อันตรายถึงชีวิต !

รู้หรือไม่ !? เห็บกัดไม่ใช่แค่คัน แต่ยังนำโรคร้ายอย่าง “โรคพยาธิเม็ดเลือด” มาสู่น้องหมาได้อีกด้วย ! 😱
                    </p>
                    <span><a href="https://www.supertriodog.com/%e0%b9%80%e0%b8%ab%e0%b9%87%e0%b8%9a%e0%b8%81%e0%b8%b1%e0%b8%94%e0%b8%a3%e0%b8%b0%e0%b8%a7%e0%b8%b1%e0%b8%87%e0%b8%9e%e0%b8%a2%e0%b8%b2%e0%b8%98%e0%b8%b4%e0%b9%80%e0%b8%a1%e0%b9%87%e0%b8%94%e0%b9%80/">อ่านต่อ</a></span>
                </div>
                <div>
                    <img src="{{asset('a3.jpg')}}">
                    <span class="bg-primary-blue p-2 text-xs font-thin text-secondary-100 block w-max">เคล็ดลับปกป้อง</span>
                    <h3 class="text-xl"><a href="https://www.supertriodog.com/%e0%b9%80%e0%b8%9c%e0%b8%a2-3-%e0%b9%80%e0%b8%ab%e0%b8%95%e0%b8%b8%e0%b8%9c%e0%b8%a5%e0%b8%88%e0%b8%b2%e0%b8%81%e0%b8%9c%e0%b8%b9%e0%b9%89%e0%b8%a3%e0%b8%b9%e0%b9%89%e0%b8%88%e0%b8%a3%e0%b8%b4/">เผย 3 เหตุผลจากผู้รู้จริง ! ทำไมปกป้องน้องหมาจากปรสิตร้ายทั้งทีต้องเสริมเกราะป้องกันถึง 3 ชั้น ?</a></h3>
                    <p>
                        พยาธิหนอนหัวใจ ปรสิตร้ายที่มียุงเป็นพาหะ เพียงการโดนยุงกัด “แค่ครั้งเดียว” ก็สามารถทำให้น้องหมาติดพยาธิหนอนหัวใจได้ การปกป้องพยาธิหนอนหัวใจในน้องหมาเป็นอีกหนึ่งการปกป้องที่สัตวแพทย์แนะนำให้เจ้าของทำอย่างต่อเนื่อง และห้ามละเลยโดยเด็ดขาด !
                    </p>
                    <span><a href="https://www.supertriodog.com/%e0%b9%80%e0%b8%9c%e0%b8%a2-3-%e0%b9%80%e0%b8%ab%e0%b8%95%e0%b8%b8%e0%b8%9c%e0%b8%a5%e0%b8%88%e0%b8%b2%e0%b8%81%e0%b8%9c%e0%b8%b9%e0%b9%89%e0%b8%a3%e0%b8%b9%e0%b9%89%e0%b8%88%e0%b8%a3%e0%b8%b4/">อ่านต่อ</a></span>
                </div>
            </div>
            <a href="https://www.supertriodog.com/wp-content/uploads/2023/01/Super-Trio-Brochure.pdf"
            class="bg-primary-blue rounded-md drop-shadow-sm text-secondary-50 text-center p-2 m-4">กดที่นี่เพื่อ Download คู่มือโปรแกรมปกป้องสุนัขจากปรสิตร้าย</a>
        </div>
        
    </div>
    <footer class="text-white w-full pt-16">
        <div class="m-auto">
            <img class="h-44 -mb-10 mx-auto" src="{{asset('footer_banner.png')}}">
        </div>
        <div class="bg-primary-blue w-full rounded-t-3xl py-8">
            <section class="container grid md:grid-cols-3 m-auto pt-8 gap-8 text-center md:text-left">
                <div>
                    <x-application-logo class="h-24 m-auto my-4" />
                    ลงทะเบียนเพื่อรับข่าวสาร คำแนะนำ และเคล็ดลับด้านสุขภาพของสุนัข
                </div> 
                <div>SITE MAP
                    <ul>
                        <li><a href="#">หน้าหลัก</a></li>
                        <li><a href="#">Super TRIO คืออะไร ?</a></li>
                        <li><a href="#">ทำไมต้องป้องกัน</a></li>
                        <li><a href="#">เคล็ดลับปกป้อง</a></li>
                        <li><a href="#">ติดต่อเราให้อุ่นใจ</a></li>
                    </ul>
                </div>
                <div>
                    แค่ติดตามก็อุ่นใจ
                    <ul>
                        <li><a href="#">@PetsSociety</a>
                        <li><a href="#">facebook.com/PetsSocietybyZoetis</a>
                    </ul>
                </div>
            </section>
        </div>
        <div class="bg-secondary-red w-full p-2">
            <section class="container grid md:grid-cols-2 m-auto text-center">
                <div class="md:text-left">
                    <a href="#">Privacy Policy</a> |  <a href="#">Cookie Settings</a>
                </div>
                <div class="md:text-right">
                    COPYRIGHT © 
                    <a href="#">Super TRIO</a>
                    2022  – ALL RIGHTS RESERVED.
                </div>
            </section>
        </div>
    </footer>
</x-base-layout>