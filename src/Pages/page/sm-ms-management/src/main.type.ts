export default interface MainInterface {
  $tc: (text: string) => string;

  $store: {
    commit: (...param: any) => void;
  };

  $Message: {
    info   : (text: string) => void;
    success: (text: string) => void;
    error  : (text: string) => void;

    destroy: () => void;
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