export default interface MainInterface {
  $tc: (text: string) => string;

  $store: {
    commit: (...param: any) => void;
  };

  $Message: {
    success: (text: string) => void;
    error  : (text: string) => void;
  }

  $Modal: {
    confirm: (param: ModalInterface) => void;
  }
}

interface ModalInterface {
  title: string;
  content: string;
  onOk: () => void;
}