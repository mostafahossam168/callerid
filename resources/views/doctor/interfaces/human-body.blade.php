<section class="main-section py-3">
    <div class="container ">
        @php
            $department = \App\Models\Department::find($this->department_id);
        @endphp
        @if ($department->is_model == 1)
            <button class="btn btn-danger btn-remove mb-3">
                @lang('admin.clear_points')
            </button>
            <div class="box-elements text-center">
                {{-- {{ $diagnose->department->name }} --}}
                <img src="{{ asset('human-body-assets/img/bg.png') }}" alt="" class="bg-body">
                @foreach ($body_parts as $body_part)
                    <div class="cr-element1 cr-element"
                        style="left: {{ $body_part['left'] }}; top: {{ $body_part['top'] }};">
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
<script>
    let boxElements = document.querySelector(".box-elements");
    let numClass = 1;
    let arrClass = [];

    function create(event) {
        //Create the element
        let element = document.createElement('div');

        // Create Class
        let classElement = "cr-element" + numClass;

        // Add Class In Arr
        arrClass.unshift(classElement)

        // Set Class And Attributes
        element.classList.add(classElement)
        element.classList.add("cr-element")

        console.log(this);
        // Edit Num Class
        numClass += 1;

        //Set CSS styles so it appears where you clicked (Top left corner)
        element.style.left = `${(event.clientX-6 -this.offsetLeft) / this.offsetWidth * 100}%`;
        element.style.top = `${(event.clientY-6+window.scrollY -this.offsetTop) / this.offsetHeight  * 100}%`;
        //Add it to the body of the document
        boxElements.appendChild(element);

        // add array of css styles to @this.body_parts
        @this.addBodyParts(element.style.left, element.style.top);
    }
    //Main event listener for clicks
    boxElements.addEventListener('click', create);

    // Remove Element
    let btnRemove = document.querySelector(".btn-remove");
    btnRemove.addEventListener("click", () => {
        if (arrClass.length >= 1) {
            let lastElement = document.querySelector(`.${arrClass[0]}`);
            lastElement.remove();
            arrClass.shift();
        }
        @this.removeBodyParts();
    })
</script>
