
namespace BOG.Models
{
    public class BogAlertMsg
    {
        public string alertMsg { get; }
        public string retryPage { get; }
        public string buttonText { get; }

        public BogAlertMsg()
        {

        }

        public BogAlertMsg(string alertMsg, string retryPage, string buttonText)
        {
            this.alertMsg = alertMsg;
            this.retryPage = retryPage;
            this.buttonText = buttonText;
        }
    }
}
