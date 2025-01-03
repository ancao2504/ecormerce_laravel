(function ($) {
    "use strict";
    var HT = {};
    var counter = 1;
    HT.addSlide = (type) => {
        $(document).on("click", ".addSlide", function (e) {
            e.preventDefault();
            if (typeof type == "undefined") {
                type = "Images";
            }

            var finder = new CKFinder();
            finder.resourceType = type;
            finder.selectActionFunction = function (fileUrl, data, allFiles) {
                let html = "";
                for (var i = 0; i < allFiles.length; i++) {
                    let image = allFiles[i].url;
                    html += HT.renderSlideItemHtml(image);
                }

                $(".slide-list").append(html);
                HT.checkSlideNotification();
            };

            finder.popup();
        });
    };

    HT.checkSlideNotification = () => {
        let slideItem = $(".slide-item");
        if (slideItem.length) {
            $(".slide-notification").hide();
        } else {
            $(".slide-notification").show();
        }
    };

    HT.renderSlideItemHtml = (image) => {
        let tab_1 = "tab-" + counter;
        let tab_2 = "tab-" + (counter + 1);

        let html = `
            <div class="col-lg-12 ui-state-default ui-sortable-handle">
                <div class="slide-item mb20">
                    <div class="row custom-row">
                        <div class="col-sm-3">
                            <div class="slide-image">
                                <img src="${image}" alt="">
                                <input type="hidden" name="slide[title][] value="${image}">
                                <span class="delete-slide"><i class="fa fa-trash"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#${tab_1}" aria-expanded="true"> Thông tin chung</a></li>
                                    <li class=""><a data-toggle="tab" href="#${tab_2}" aria-expanded="false">SEO</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="${tab_1}" class="tab-pane active">
                                        <div class="panel-body">
                                            <div class="label-text mb5">Mô tả</div>
                                            <div class="form-row mb10">
                                                <textarea name="slide[description][]" id="" class="form-control"></textarea>
                                            </div>
                                            <div class="form-row form-row-url">
                                                <input type="text" class="form-control" placeholder="URL" name="slide[url][]">
                                                <div class="overlay">
                                                    <div class="uk-flex uk-flex-middle">
                                                        <label for="input_${tab_1}">Mở trong tab mới</label>
                                                        <input type="checkbox" name="_blank" value="" id="input_${tab_1}" name="slide[window][]">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="${tab_2}" class="tab-pane">
                                        <div class="panel-body">
                                            <div class="form-row form-row-url slide-seo-tab mb15">
                                                <div class="label-text mb5">Tiêu đề ảnh</div>
                                                <input type="text" class="form-control" placeholder="Tiêu đề ảnh" name="slide[name][]">
                                            </div>

                                            <div class="form-row form-row-url slide-seo-tab">
                                                <div class="label-text mb5">Mô tả ảnh</div>
                                                <input type="text" class="form-control" placeholder="Mô tả ảnh" name="slide[alt][]">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
        `;

        counter += 2;

        return html;
    };

    HT.deleteSlide = () => {
        $(document).on("click", ".delete-slide", function (e) {
            e.preventDefault();
            let _this = $(this);
            _this.parents(".ui-state-default").remove();
            HT.checkSlideNotification();
        });
    };

    $(document).ready(function () {
        HT.addSlide();
        HT.deleteSlide();
    });
})(jQuery);
