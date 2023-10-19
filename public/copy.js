 // CopyText and show alert
 function CopyTextOntraffic(element, alertMessage, timeHide) {
     $(element).on('click', function() {
         const content = $(this).text().trim();
         copyToClipboard(content);

         const tooltip = $('<div class="tooltip-ontraffic">' + alertMessage + '</div>');
         $(this).append(tooltip);

         const rect = this.getBoundingClientRect();
         tooltip.css({
             top: rect.top - tooltip.outerHeight() - 8,
             left: rect.left + rect.width / 2 - tooltip.outerWidth() / 2,
         });

         setTimeout(function() {
             tooltip.remove();
         }, timeHide);
     });

     function copyToClipboard(text) {
         const textarea = $('<textarea></textarea>');
         textarea.val(text);
         $('body').append(textarea);
         textarea.select();
         document.execCommand('copy');
         textarea.remove();
     }
 }