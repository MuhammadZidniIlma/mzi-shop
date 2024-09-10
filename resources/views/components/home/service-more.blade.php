<div class="we-help-section">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-7 mb-5 mb-lg-0">
                <div class="imgs-grid">
                    <div class="grid grid-1"><img src="images/img-grid-1.jpg" alt="Untree.co"></div>
                    <div class="grid grid-2"><img src="images/img-grid-2.jpg" alt="Untree.co"></div>
                    <div class="grid grid-3"><img src="images/img-grid-3.jpg" alt="Untree.co"></div>
                </div>
            </div>
            <div class="col-lg-5 ps-lg-5">
                <h2 class="section-title mb-4">We Help You Make Modern Interior Design</h2>
                <p>At mzi shop, we specialize in transforming your living spaces into modern, stylish environments. Our
                    expertise in marble design and commitment to quality ensure that every detail enhances the beauty
                    and functionality of your home. Here’s how we make it happen</p>

                <ul class="list-unstyled custom-list my-4">
                    <li>Transform Your Space with Elegance</li>
                    <li>Expert Guidance for a Seamless Experience</li>
                    <li>Innovative Solutions for Every Space</li>
                    <li>Quality and Durability Combined</li>
                </ul>
                @if (isset($url))
                    <a href="{{ route('service') }}" class="btn">{{ $url }}</a>
                @endif
            </div>
        </div>
    </div>
</div>
